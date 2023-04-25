<?php
declare(strict_types=1);

use Nette\PhpGenerator\Dumper;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

include __DIR__ . '/vendor/autoload.php';

$rawHtml = file_get_contents('https://www.mcc-mnc.com');

$crawler = new DomCrawler($rawHtml);
$data = [];
$crawler->filterXPath('//*[@id="mncmccTable"]/tbody/tr')->each(function(DomCrawler $node) use (&$data): void {
    $tds = $node->children();
    $mcc = (int)$tds->eq(0)->text();
    $countryCode = strtoupper($tds->eq(2)->text());
    if ($countryCode === 'N/A') {
        return;
    }

    if (!isset($data[$countryCode])) {
        $data[$countryCode] = [
            'code' => $countryCode,
            'mcc' => $mcc,
        ];
    }
});

$serialized = (new Dumper())->dump(array_values($data));
$dump = <<<EOF
<?php
declare(strict_types=1);

return {$serialized};

EOF;

file_put_contents(__DIR__ . '/src/data.php', $dump);
