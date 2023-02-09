<?php

namespace Kirby\Eleventy;

use Kirby\Data\Data;
use Kirby\Data\Handler;
use Kirby\Toolkit\Str;

class Frontmatter extends Handler
{
	/**
	 * Converts an array to frontmatter
	 */
	public static function encode($data): string
	{
		$content = $data['content'] ?? null;

		unset($data['content']);

		// remove all null values
		$data = array_filter($data, function ($item) {
			return $item !== null;
		});

        $md[] = '---';
        $md[] = trim(Data::encode($data, 'yml'));
        $md[] = '---';
		$md[] = $content;

        return implode(PHP_EOL, $md);
	}

	/**
	 * Parses frontmatter
	 */
	public static function decode($string): array
	{
        $parts = Str::split($string, '---' . PHP_EOL);
        $yaml  = Data::decode($parts[0] ?? '', 'yml');

		if (empty($parts[1]) === false) {
			$yaml['content'] ??= $parts[1];
		}

        return $yaml;
	}
}
