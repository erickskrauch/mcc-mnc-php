<?php
declare(strict_types=1);

namespace ErickSkrauch\MccMnc\Tests;

use ErickSkrauch\MccMnc\Reference;
use ErickSkrauch\MccMnc\UnknownException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \ErickSkrauch\MccMnc\Reference
 * @covers \ErickSkrauch\MccMnc\UnknownException
 */
final class ReferenceTest extends TestCase {

    public function testCountryFromExistsMcc(): void {
        $this->assertSame('PL', Reference::countryFromMcc(260));
    }

    public function testCountryFromUnknownMcc(): void {
        $this->expectException(UnknownException::class);
        Reference::countryFromMcc(999);
    }

    public function testMccFromExistsCountry(): void {
        $this->assertSame(260, Reference::mccFromCountry('PL'));
    }

    public function testMccFromUnknownCountry(): void {
        $this->expectException(UnknownException::class);
        Reference::mccFromCountry('XX');
    }

}
