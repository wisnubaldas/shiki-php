<?php

namespace Spatie\ShikiPhp\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\ShikiPhp\Shiki;
use Spatie\Snapshots\MatchesSnapshots;

class ShikiTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_can_render_html()
    {
        $code = '<?php echo "Hello World"; ?>';

        $this->assertMatchesSnapshot(Shiki::codeToHtml($code));
    }

    /** @test */
    public function it_can_highlight_blade()
    {
        $code = '@if(true) {{ "Hello world" }} @endif';

        $this->assertMatchesSnapshot(Shiki::codeToHtml($code, language: 'blade'));
    }

    /** @test */
    public function it_can_highlight_antlers()
    {
        $code = '{{ if }} Hi there {{ /if }}';

        $this->assertMatchesSnapshot(Shiki::codeToHtml($code, language: 'antlers'));
    }

    /** @test */
    public function it_can_render_for_a_specific_language()
    {
        $code = 'console.log("Hello world")';

        $this->assertMatchesSnapshot(Shiki::codeToHtml($code, 'js'));
    }

    /** @test */
    public function it_can_accept_different_themes()
    {
        $code = '<?php echo "Hello World"; ?>';

        $this->assertMatchesSnapshot(Shiki::codeToHtml($code, theme: 'github-light'));
    }

    /** @test */
    public function it_throws_on_invalid_theme()
    {
        $code = '<?php echo "Hello World"; ?>';

        $this->expectExceptionMessage("Invalid theme `invalid-theme`");

        Shiki::codeToHtml($code, theme: 'invalid-theme');
    }

    /** @test */
    public function it_throws_on_invalid_language()
    {
        $code = '<?php echo "Hello World"; ?>';

        $this->expectExceptionMessage("Invalid language `invalid-language`");

        Shiki::codeToHtml($code, language: 'invalid-language');
    }

    /** @test * */
    public function it_can_get_available_languages()
    {
        $languages = Shiki::languages();

        $this->assertGreaterThan(0, $languages->count());
    }

    /** @test * */
    public function it_can_get_available_themes()
    {
        $themes = Shiki::themes();

        $this->assertGreaterThan(0, $themes->count());
    }

    /** @test * */
    public function it_can_receive_a_custom_theme()
    {
        $code = '<?php echo "Hello World"; ?>';

        $this->assertMatchesSnapshot(Shiki::codeToHtml($code, theme: __DIR__ . '/testfiles/ayu-light.json'));
    }
}
