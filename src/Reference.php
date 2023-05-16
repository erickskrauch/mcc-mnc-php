<?php
declare(strict_types=1);

namespace ErickSkrauch\MccMnc;

final class Reference {

    private static ?array $data = null;

    /**
     * @return string[]
     * @phpstan-return non-empty-array<string>
     * @throws \ErickSkrauch\MccMnc\UnknownException
     */
    public static function countryFromMcc(int $mcc): array {
        $countries = [];
        foreach (self::getData() as $data) {
            if (in_array($mcc, $data['mcc'], true)) {
                $countries[] = $data['code'];
            }
        }

        if (empty($countries)) {
            throw new UnknownException();
        }

        return $countries;
    }

    /**
     * @return int[]
     * @phpstan-return non-empty-array<int>
     * @throws \ErickSkrauch\MccMnc\UnknownException
     */
    public static function mccFromCountry(string $countryCode): array {
        foreach (self::getData() as $data) {
            if ($data['code'] === $countryCode) {
                return $data['mcc'];
            }
        }

        throw new UnknownException();
    }

    /**
     * @return array<array{code: string, mcc: int}>
     */
    private static function getData(): array {
        if (self::$data === null) {
            self::$data = require __DIR__ . '/data.php';
        }

        return self::$data;
    }

}
