<?php

namespace App\Helpers;

/**
 * Exception wrapper
 * To gracfully handle exceptions
 */
class ExceptionHelper
{
	
	public static function somethingWentWrong($e)
	{
		report($e);
		return self::somethingWentWrongText();
	}

	public static function customError($e)
	{
		report($e);
        return view('errors.index')->withErrors(['error' => self::somethingWentWrongText()]);
	}

	public static function somethingWentWrongText(){
		return 'Something went wrong on server. Contact the department if the issue persists';
	}
}