<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use App\Models\CitizensModel;

class OnlyOneFamilyHead implements ValidationRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param Closure(string): PotentiallyTranslatedString $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		$familyCardId = $value; // Assuming $value is familyCardId.

		// assuming status 1 indicates a family head
		$existingHeadCount = CitizensModel::where('id_hubungan', 1)
			->where('id_kk', $familyCardId)->count();

		if ($existingHeadCount >= 1) {
			$fail('There can only be one family head in a single family card.');
		}
	}
}
