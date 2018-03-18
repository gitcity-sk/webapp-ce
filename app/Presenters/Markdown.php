<?php

namespace App\Presenters;

class Markdown extends \Parsedown
{
    /**
     * @param $Excerpt
     * @return array|void
     */
    protected function inlineImage($Excerpt)
    {
        if (! isset($Excerpt['text'][1]) or $Excerpt['text'][1] !== '[') {
            return;
        }

        $Excerpt['text'] = substr($Excerpt['text'], 1);

        $Link = $this->inlineLink($Excerpt);

        if ($Link === null) {
            return;
        }

        $Inline = [
            'extent' => $Link['extent'] + 1,
            'element' => [
                'name' => 'img',
                'attributes' => [
                    'src' => $Link['element']['attributes']['href'],
                    'alt' => $Link['element']['text'],
                    'class' => 'img-fluid'
                ],
            ],
        ];

        $Inline['element']['attributes'] += $Link['element']['attributes'];

        unset($Inline['element']['attributes']['href']);

        return $Inline;
    }

    /**
     * @param array $block
     * @return array|null
     */
    protected function blockListComplete(array $block)
    {
        if (null === $block) {
            return null;
        }

        if (false === isset($block['element']) || false === isset($block['element']['text']) || false === is_array($block['element']['text'])) {
            return $block;
        }

        $count_element = count($block['element']['text']);
        for ($iterator_element = 0; $iterator_element < $count_element; $iterator_element++) {
            if (false === isset($block['element']['text'][$iterator_element]['text']) || false === is_array($block['element']['text'][$iterator_element]['text'])) {
                continue;
            }

            $count_text = count($block['element']['text'][$iterator_element]['text']);

            for ($iterator_text = 0; $iterator_text < $count_text; $iterator_text++) {
                $begin_line = substr(trim($block['element']['text'][$iterator_element]['text'][$iterator_text]), 0, 4);
                if ('[ ] ' === $begin_line) {
                    $block['element']['text'][$iterator_element]['text'][$iterator_text] = '<input type="checkbox" disabled /> '.
                        substr(trim($block['element']['text'][$iterator_element]['text'][$iterator_text]), 4);
                    $block['element']['text'][$iterator_element]['attributes'] = ['class' => 'parsedown-task-list parsedown-task-list-open'];
                } 
                
                if ('[x] ' === $begin_line) {
                    $block['element']['text'][$iterator_element]['text'][$iterator_text] = '<input type="checkbox" checked disabled /> '.
                        substr(trim($block['element']['text'][$iterator_element]['text'][$iterator_text]), 4);
                    $block['element']['text'][$iterator_element]['attributes'] = ['class' => 'parsedown-task-list parsedown-task-list-close'];
                }
            }
        }

        return $block;
    }
}
