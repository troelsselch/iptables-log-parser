<?php

/**
 * @author: Troels Selch
 */

run();

function run() {
  $logfilename = './messages-20140209';
  $logfile = fopen($logfilename, 'rb');

  $ipsout = fopen('./ips.txt', 'wb+');
  $valuesout = fopen('./values.txt', 'wb+');

  $ips = array();
  $values = array();
  while ($line = fgets($logfile)) {
    if (strpos($line, 'DST=') !== FALSE) {
      $value = parse_line($line);
      $values[] = $value;

      if (trim($value['DST']) != '') {
        add_ip($ips, $value['DST']);
      }
    }
  }
  fclose($logfile);

  fwrite($ipsout, print_r($ips, TRUE));
  fwrite($valuesout, print_r($values, TRUE));
  fclose($ipsout);
  fclose($valuesout);
}

function parse_line($line) {
  $keyvals = array();
  $cols = explode(' ', $line);
  foreach ($cols as $entry) {
    if (strpos($entry, '=') !== FALSE) {
      $keyval = explode('=', $entry);
      if ($keyval[0] == 'DST' && strlen($keyval[1] < 7)) {
        //print print_r($cols, TRUE) . "\n";
      }
      $keyvals[$keyval[0]] = $keyval[1];
    }
  }
  return $keyvals;
}

function add_ip(&$ips, $dst) {
  if (!array_key_exists($dst, $ips)) {
    //print "First occurence of $dst\n";
    $ips[$dst] = 0;
  }
  $ips[$dst]++;
}
