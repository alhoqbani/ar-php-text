<?php

use Alhoqbani\ArPHP\AutoSummarize;
use PHPUnit\Framework\TestCase;


class AutoSummarizeTest extends TestCase
{

    /** @test */
    public function it_can_read_required_txt_files()
    {
        $this->assertFileIsReadable(
            'src/data/ar-stopwords.txt',
            "Requerid file ar-stopwords.txt is missing");
        $this->assertFileIsReadable(
            'src/data/en-stopwords.txt',
            "Requerid file en-stopwords.txt is missing");
        $this->assertFileIsReadable(
            'src/data/important-words.txt',
            "Requerid file impostant is missing");
    }

    /** @test */
    public function it_can_clean_common_word()
    {
        $auto_summarize = new AutoSummarize();
        $text = 'مايو كانون جميع ';
        $cleaned_text = $auto_summarize->cleanCommon($text);
        $this->assertNotContains('جميع', $cleaned_text);
    }

    /** @test */
    public function it_extract_keywords_from_a_given_Arabic_string()
    {
        $str = file_get_contents(__DIR__ . '/TestAssets/article.txt');
        $auto_summarize = new AutoSummarize();
        $extracted_keywords = $auto_summarize->getMetaKeywords($str, 3);
        $expected_keywords = "اطفال، اكثر، ضرار";

        $this->assertEquals(
            $expected_keywords,
            $extracted_keywords
        );
    }

    /** @test */
    public function it_highlight_key_sentences_as_percentage_of_the_input_string()
    {
        $this->markTestSkipped('Need to find better way to test');
        $str = file_get_contents(__DIR__ . '/TestAssets/article.txt');
        $auto_summarize = new AutoSummarize();
        $highlight_summary = $auto_summarize->highlightRateSummary($str, 20, 'الأطفال', 'styled');
        $expected_text = file_get_contents(__DIR__ . '/highlighted_summary.txt');

        $this->assertEquals(
            $expected_text,
            $highlight_summary

        );


    }

}