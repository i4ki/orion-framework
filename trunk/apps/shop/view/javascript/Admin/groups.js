document.charset = 'utf-8';
	$j = jQuery.noConflict();
	$j(document).ready(function() {
		$j('.services').hover(
			function() {
				$j(this).css('background', '#F3F9FF');
			},
			function() {
				$j(this).css('background', '');
			}
		);
		
		/**
		 * Apaga os cookies de permissões antigas
		 */
		eraseOldPermissionsInCookies();
		
		<?js:$createCookie_If_EditGroup?>

		$j('#saveGroup').submit(function() {
			createGroupByName();
			return false;
		});		
	});
	
	/**
	 * Apaga os cookies de permissões antigas
	 */
	function eraseOldPermissionsInCookies(name, pattern, resources) {
		name = (name == null) ? false : true;
		pattern = (pattern == null) ? false : true;
		resources = (resources == null) ? false : true;
		
		if(name == false) {
			eraseCookie('nameGroup');
		}
		if(pattern == false) {
			eraseCookie('pattern');
		}
		if( resources == false ) {
			for(var i=0; i<20; i++) {
				eraseCookie('resource_'+i);
			}
		}
	}
	
	function createGroupByName() {

		/**
		 * Criando o grupo
		 */
		var name = $j('#name').attr('value');
		if( name == '' || name === null ) {
			alert('Voce deve especificar um nome para o grupo');
			return false;
		} else {
			var cookie = createCookie('nameGroup', name, 1);
			if(  cookie === true ) {
				disableNameGroup();
			} else {
				alert('Você deve habilitar os cookies do seu navegador para completar a operação!');
			}
		}
	}
	
	
	
	function alterRolePattern( value ) {
		$j('#role_pattern').attr('value', value);
	}
	
	function loadResources( service, pattern ) {
		
		createCookie('serviceActive', $j('#service_'+service).text());
		
		Ajax.prototype.beforeSend = function() {
			$j('#divRoleResource').html('<center><img src="<?js:$pathAdmin?>img/ajax-loader.gif" /></center>');
		}
		Ajax.prototype.success = function( response ) {
			$j('#divRoleResource').html(response);
			if( pattern == 0 ) {
				setPermissionDefault();
				populeBoxWithValuesInCookies();
			} else {
				eraseOldPermissionsInCookies(1);
				createCookie('pattern', pattern);
			}
			if( $j('#divRoleResource select option:selected').attr('value') != 0 ) {
				
				$j(':checkbox').click(function() {
					$j('#role').attr('value',0);
					$j('#role_pattern').attr('value',0);
					eraseCookie('pattern');
				});
			}
		}
		pattern = (pattern != null)?pattern:'';
		var ajax = new Ajax('<?js:$URL?>Admin/Manager/Groups/Get/'+service+'/'+pattern+'/null/Ajax');
		ajax.send();

	}
	
	function setPermissionDefault() {
		$j('.view').attr('checked', 'checked');
	}
	
	/**
	 * Popula as checkbox se tiver permissões salvas
	 * em cookies.
	 */
	function populeBoxWithValuesInCookies() {
		var cookies = document.cookie.split(';');
		for(var i=0; i<cookies.length;i++) {
			
			var id = cookies[i].match(/resource_([\d+$])/);
			if(id != null) {
				
				var res_cookie = readCookie('resource_'+id[1]);
				var perm = res_cookie.split('-');
				if( perm[0] == 1 || perm[0] == '1') {
					$j('#create_'+id[1]).attr('checked','checked');
				} else {
					$j('#create_'+id[1]).removeAttr('checked');
				}
				if( perm[1] == 1 || perm[1] == '1' ) {
					$j('#edit_'+id[1]).attr('checked','checked');
				} else {
					$j('edit_'+id[1]).removeAttr('checked');
				}
				if( perm[2] == 1 || perm[2] == '1' ) {
					$j('#delete_'+id[1]).attr('checked','checked');
				} else {
					$j('#delete_'+id[1]).removeAttr('checked');
				}
				if( perm[3] == 1 || perm[3] == '1' ) {
					$j('#view_'+id[1]).attr('checked','checked');
				} else {
					$j('#view_'+id[1]).removeAttr('checked');
				}
				
			}			
		}
	}
	
	function savePermission() {
		/**
		 * Nome do grupo
		 */
		var name = $j('#name').attr('value');
		if(name == '') {
			alert('Indique um nome para o grupo');
			return false;
		}
		var pattern = $j('#role').attr('value');
		
		var value = 0;
		/**
		 * Variavel enviada ao server
		 */
		var data = '';
		data += 'name='+name+'&pattern='+pattern+'&';
		for( i = 0; i < $j('.permission').length; i++ ) {
			var idResource = $j('.permission:eq('+i+')').find('tr:eq(1)').attr('id');
						
			value = $j('#create_'+idResource).attr('checked') === true ? 1 : 0;
			data += 'create_'+idResource+'='+value+'&';
			value = $j('#edit_'+idResource).attr('checked') === true ? 1 : 0;
			data += 'edit_'+idResource+'='+value+'&';
			value = $j('#delete_'+idResource).attr('checked') === true ? 1 : 0;
			data += 'delete_'+idResource+'='+value+'&';
			value = $j('#view_'+idResource).attr('checked') === true ? 1 : 0;
			data += 'view_'+idResource+'='+value+'&';			
		}
		Ajax.prototype.success = function( response ) {
			$j('#divRoleResource').html(response);	
		}
		
		
		ajax = new Ajax('<?js:$URL?>Admin/Manager/Groups/SavePermission/null/null/null/Ajax');
		ajax.send(null, data);
		disableNameGroup();
	}
	
	/**
	 * Salva as permissões em cookies
	 * para deixar o processo menos burocrático e agilizar,
	 * submetendo as informações apenas uma vez ao servidor
	 */
	function savePermissionInCookie() {
		nameGroup = readCookie('nameGroup');
		if(nameGroup == '' || nameGroup === null) {
			alert('Voce deve especificar um nome para o grupo!');
			return false;
		} else {
			var pattern = $j('#role').attr('value');
			var data = '';
			var value = 0;
			for( var i = 0; i<$j('.permission').length; i++ ) {
				var idResource = $j('.permission:eq('+i+')').find('tr:eq(1)').attr('id');
				value = $j('#create_'+idResource).attr('checked') === true ? 1 : 0;
				value += '-'+($j('#edit_'+idResource).attr('checked') === true ? 1 : 0);
				value += '-'+($j('#delete_'+idResource).attr('checked') === true ? 1 : 0);
				value += '-'+($j('#view_'+idResource).attr('checked') === true ? 1 : 0);
				var cookie = createCookie('resource_'+idResource, value) === true
			}

			if( cookie === true ) {
				alert('Permissões sobre \"'+readCookie('serviceActive')+'\" salvas com sucesso');
			} else {
				alert('Você deve habilitar os cookies do seu navegador para completar a operação!');
			}		
		}
	}
	
	function disableNameGroup() {
		if( $j('#name').attr('type') == 'text') {
			var name = "<span name=\"name\" id=\"name\"><strong>"+$j('#name').attr('value')+"</strong></span><br />\n";
			$j('#name').replaceWith(name);
			$j('#createGroup').hide();
		}
	}
	
	function allowNameGroup() {
		if ($j('#name').is('span')) {
			var name = "<input type=\"text\" name=\"name\" id=\"name\" value=\""+$j('#name').text()+"\" />\n";
			$j('#name').replaceWith(name);
		}
	}
	
	function selectPerfil( role ) {
		Ajax.prototype.beforeSend = function() {
			$j('#loader').html('<img src="<?js:$pathAdmin?>img/ajax-loader.gif\" />');
		}
		Ajax.prototype.success = function( response ) {
			$j('#divRoleResource').html(response);
		}
		ajax = new Ajax('<?js:$URL?>Admin/Manager/Groups/SavePermission/null/null/null/Ajax');
		ajax.send(null)
	}
	
	function gravar() {
		var name = readCookie('nameGroup');
		if(name == null || name =='') {
			alert('Você precisa inserir um nome para o grupo');
			return false;
		} else {
			location.href="<?js:$way_for_record_groups?>";
		}
	}