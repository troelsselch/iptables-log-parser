iptables-log-parser
===================

PHP script to read an iptables log file and (currently) just lists outgoing ip adresses.

What's this?
This php file will run through a messages log file generated by iptables,
pulling out ips that have been connected to.

Todo
----

- Add reference to vagrant project
- Make configurable (maybe a class?)
- Update readme 
- Describe iptables setup (iptables -I OUTPUT 1 -p tcp -j LOG);
- Add other functionality? (Should this be an "iptables log parser"?)

Author
------

Troels Selch
