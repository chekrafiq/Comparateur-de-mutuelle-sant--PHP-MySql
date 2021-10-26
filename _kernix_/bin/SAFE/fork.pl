#!/usr/bin/perl
print "test\n";
print "test\n";
print "test";

exit 0;

print "->test";

exit 0;

$i = 1;
while ($i <= 2)
{
    $i++;
    if ($pid = fork)
    {
	print "execution started";
	exit 0;
    }
    else
    {
	`test.php`;
    }
}
