<?php

function testPerformanceWithBrackets()
{
   for($i=0;$i<10000;$i++)
   {
      for($j=0;$j<1000;$j++)
      {
         if($i == $j)
         {
             printf("i == j, entrando no terceiro estágio do teste:\n");
             for($t=1000;$t>0;$t--)
             {
                if($t%2 == 0)
                {
                    print "t modulo 2 == 0\n";
                } else {
                    print "t modulo 2 !== 0\n";
                }
             }
         } else {
             print "i !== j\n";
         }
      }
   }
}

function testPerformanceWithoutBrackets()
{
   for($i=0;$i<10000;$i++)
      for($j=0;$j<1000;$j++)
         if($i == $j)
         {
             printf("i == j, entrando no terceiro estágio do teste:\n");
             for($t=1000;$t>0;$t--)
                if($t%2 == 0)
                    print "t modulo 2 == 0\n";
                else
                    print "t modulo 2 !== 0\n";
         } else
             print "i !== j\n";
}

$time = microtime();
$time = explode(" ", $time);
$msec = $time[0];
$sec = $time[1];
$time1 = 0;
$time1 = $sec + $msec;
print "inicio: ".$time1."\n";

testPerformanceWithoutBrackets();

$time = microtime();
$time = explode(" ", $time);
$msec = $time[0];
$sec = $time[1];
$time2 = 0;
$time2 = $sec + $msec;
print "fim: ".$time2."\n";
print "\n";
print "diferença: ".($time2 - $time1)."\n";

/*
$soma1 = (6.09199500084)+(6.18124508858)+(6.10172581673)+(6.23723006248)+(6.07405805588);
$soma1 = (float) ($soma1/5);
print "soma : with Bracket == ".$soma1."\n";

$soma2 = (6.10297083855)+(6.10806107521)+(6.26417589188)+(6.11736917496)+(6.14453697205);
$soma2 = (float) ($soma2/5);
print "soma : without brackets == ".$soma2."\n";
*/