<?php
declare(strict_types=1);

namespace ErickSkrauch\MccMnc;

final class Reference {

    private static ?array $data = null;

    /**
     * @throws \ErickSkrauch\MccMnc\UnknownException
     */
    public static function countryFromMcc(int $mcc): string {
        foreach (self::getData() as $data) {
            if ($data['mcc'] === $mcc) {
                return $data['code'];
            }
        }

        throw new UnknownException();
    }

    /**
     * @throws \ErickSkrauch\MccMnc\UnknownException
     */
    public static function mccFromCountry(string $countryCode): int {
        foreach (self::getData() as $data) {
            if ($data['code'] === $countryCode) {
                return $data['mcc'];
            }
        }

        throw new UnknownException();
    }

    /**
     * @return array{array{code: string, mcc: int}}
     */
    private static function getData(): array {
        if (self::$data === null) {
            self::$data = require __DIR__ . '/data.php';
        }

        return self::$data;
    }

}
