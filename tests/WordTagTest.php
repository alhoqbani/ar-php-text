<?php

use Alhoqbani\ArPHP\WordTag;
use PHPUnit\Framework\TestCase;


class WordTagTest extends TestCase
{

    /** @test */
    public function it_can_read_required_txt_files()
    {
        $this->assertFileIsReadable(
            'src/data/ar-stopwords.txt',
            "Requerid file ar-stopwords.txt is missing");
    }

    /** @test */
    public function it_can_tell_if_a_noun_is_a_noune()
    {
        $word_tag = new WordTag();
        $text = ' السماء ';
        $word_before = 'في';
        $noun = $word_tag->isNoun($text, $word_before);
        $this->assertTrue(
            $noun,
            'The Class should recognize السماء as a noune');
    }

    /** @test */
    public function it_highlighted_all_nouns_in_a_given_arabic_string()
    {
        $word_tag = new WordTag();
        $string = 'ومن بينهم مصور قناة الجزيرة';
        $highlighted_text = $word_tag->highlightText($string, 'noun');
        $expected_highlighted_text = '<span class="noun">  مصور  قناة  الجزيرة</span>';
        $this->assertContains(
            $expected_highlighted_text,
            $highlighted_text,
            "It expects the highlighted text to be {$expected_highlighted_text},
                    but it got {$highlighted_text}"
        );

    }

    /** @test */
    public function it_tags_all_words_in_a_given_Arabic_string_if_they_are_nouns_or_not()
    {
        $word_tag = new WordTag();
        $string = 'أكل أحمد التفاحة وذهب مع أخيه إلى المدرسة';

        $taged_word = $word_tag->tagText($string);
        $expected_taged_word = [
            ["أكل", 0],
            ["أحمد", 1],
            ["التفاحة", 1],
            ["وذهب", 0],
            ["مع", 0],
            ["أخيه", 1],
            ["إلى", 0],
            ["المدرسة", 1],
        ];

        $this->assertEquals(
            $expected_taged_word,
            $taged_word,
            "it expexts tagged words array,
                        to match the expected array"
        );


    }

}