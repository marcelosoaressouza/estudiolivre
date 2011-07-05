#!/usr/bin/perl 

use strict;
require XML::Simple;

$ARGV[0] and $ARGV[1] or die 'must at least supply action mountPoint';
die "action must be add, update or delete"
    unless $ARGV[0] =~ /add|update|delete/;
if ($ARGV[0] =~ /add|update/) {
	$ARGV[2] or die "add or update must supply password";
	die 'mountPoint and password must be plain text without blank spaces'
	    unless $ARGV[1] =~ /^[a-zA-Z0-9]+$/ and $ARGV[2] =~ /^[a-zA-Z0-9]+$/;
}

our $mountPoint = $ARGV[1];
our $pass = $ARGV[2];

our $xs = new XML::Simple();
our $ref = $xs->XMLin('/etc/icecast2/icecast.xml');

my $action = $ARGV[0];

if ($action eq 'add') {
    exit 1 unless add();
} elsif ($action eq 'update') {
    exit 1 unless update();
} elsif ($action eq 'delete') {
	exit 1 unless deleteMount();
}

open ARQ, '>/etc/icecast2/icecast.xml' or die "open(): $!";
our $fh = \*ARQ;
my $xml = $xs->XMLout($ref, NoAttr => 1, RootName => 'icecast', OutputFile => $fh);
close ARQ;

exit 0;

sub add {
    foreach my $mount (@{$ref->{mount}}) {
		if ($mount->{'mount-name'} eq "/$mountPoint") {
		    return 0;
		}
    }

    my $new_point = {'mount-name' => "/$mountPoint",
		     'password' => $pass,
	      	     'burst-size' => 65536,
	     	     'hidden' => 0,
	     	     'no-yp' => 1};

    my $mounts = $ref->{mount};
    
    $mounts->[@$mounts] = $new_point;
    $ref->{mount} = $mounts;
    return 1;
}

sub update {
    foreach my $mount (@{$ref->{mount}}) {
		if ($mount->{'mount-name'} eq "/$mountPoint") {
		    $mount->{'password'} = $pass;
		}
    }
    return 1;
}

sub deleteMount {
	my $mounts = $ref->{mount};
	for (my $i = 0; $i < @$mounts; $i++) {
		if ($mounts->[$i]->{'mount-name'} eq "/$mountPoint") {
		    splice(@{$mounts}, $i, 1);
		}
    }
    return 1;
}
