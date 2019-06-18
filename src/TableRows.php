<?php

declare(strict_types=1);

/*
 * This is part of the webuni/commonmark-table-extension package.
 *
 * (c) Martin Hasoň <martin.hason@gmail.com>
 * (c) Webuni s.r.o. <info@webuni.cz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webuni\CommonMark\TableExtension;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;
use League\CommonMark\Node\Node;

class TableRows extends AbstractBlock
{
    const TYPE_HEAD = 'thead';
    const TYPE_BODY = 'tbody';

    public $type = self::TYPE_BODY;

    public function __construct(string $type = self::TYPE_BODY)
    {
        //parent::__construct();
        $this->type = $type;
    }

    public function isHead(): bool
    {
        return self::TYPE_HEAD === $this->type;
    }

    public function isBody(): bool
    {
        return self::TYPE_BODY === $this->type;
    }

    public function canContain(AbstractBlock $block): bool
    {
        return $block instanceof TableRow;
    }

    public function acceptsLines(): bool
    {
        return false;
    }

    public function isCode(): bool
    {
        return false;
    }

    public function matchesNextLine(Cursor $cursor): bool
    {
        return false;
    }

    public function handleRemainingContents(ContextInterface $context, Cursor $cursor): void
    {
    }

    /**
     * @return AbstractBlock[]
     */
    public function children(): array
    {
        return array_filter(parent::children(), function (Node $child): bool { return $child instanceof AbstractBlock; });
    }
}
