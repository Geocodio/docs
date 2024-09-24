<?php

// Initial files
file_put_contents('source/enterprise/index.html.md',
    str_replace(
        'api.geocod.io', 'api.enterprise.geocod.io',
        file_get_contents('source.html.md.tmp')
    )
);

$content = file_get_contents('source/enterprise/index.html.md');
$content = str_replace('dash.geocod.io', 'dash.enterprise.geocod.io', $content);
file_put_contents('source/enterprise/index.html.md', $content);

copy('source.html.md.tmp', 'source/index.html.md');
unlink('source.html.md.tmp');

// Enterprise
$content = file_get_contents('source/enterprise/index.html.md');
$content = str_replace('<!--ENTERPRISE', '', $content);
$content = str_replace('ENTERPRISE-->', '', $content);
file_put_contents('source/enterprise/index.html.md', $content);

// Non-enterprise
$content = file_get_contents('source/index.html.md');
$content = str_replace('<!--DEFAULT', '', $content);
$content = str_replace('DEFAULT-->', '', $content);
file_put_contents('source/index.html.md', $content);
