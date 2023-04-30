<?php
declare(strict_types=1);

use Nette\PhpGenerator\Dumper;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

include __DIR__ . '/vendor/autoload.php';

$rawHtml = file_get_contents('https://en.wikipedia.org/wiki/Mobile_country_code');

$crawler = new DomCrawler($rawHtml);
$data = [];
$latestCountryCode = null;
$latestMcc = null;
$crawler
    ->filterXPath('//*[@id="National_operators"]/parent::*/following-sibling::table[1]/tbody/tr')
    ->each(function(DomCrawler $node, int $i) use (&$data, &$latestCountryCode, &$latestMcc): void {
        if ($i === 0) {
            return;
        }

        $tds = $node->children();
        $mcc = (int)$tds->eq(0)->text();
        if ($mcc === 0) {
            $countryCode = $tds->eq(0)->text();
            $mcc = $latestMcc;
        } else {
            if ($tds->count() > 2) {
                $countryCode = $tds->eq(2)->text();
            } else {
                $countryCode = $latestCountryCode;
            }
        }

        $latestCountryCode = $countryCode;
        $latestMcc = $mcc;

        $country = &$data[$countryCode];
        $country['code'] = $countryCode;
        $country['mcc'][] = $mcc;
    });

ksort($data);

$serialized = (new Dumper())->dump(array_values($data));
$dump = <<<EOF
<?php
declare(strict_types=1);

return {$serialized};

EOF;

file_put_contents(__DIR__ . '/src/data.php', $dump);
