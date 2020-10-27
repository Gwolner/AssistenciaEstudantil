<?php
/**
 * BCGcode128.barcode.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - Code 128, A, B, C
 *
 * # Code C Working properly only on PHP4 or PHP5.0.3+ due to bug :
 * http://bugs.php.net/bug.php?id=28862
 *
 * !! Warning !!
 * If you display the checksum on the label, you may obtain
 * some garbage since some characters are not displayable.
 *
 *--------------------------------------------------------------------
 * Revision History
 * v2.1.0	8  nov	2009	Jean-S�bastien Goupil	Specify exact table for encoding
 * v2.0.1	8  mar	2009	Jean-S�bastien Goupil	Fix Code 128 C
 * v2.00	23 apr	2008	Jean-S�bastien Goupil	New Version Update
 * v1.2.3pl2	27 sep	2006	Jean-S�bastien Goupil	There were some errors dealing with C table
 * v1.2.3b	30 dec	2005	Jean-S�bastien Goupil	Checksum separated + PHP5.1 compatible
 * v1.2.1	27 jun	2005	Jean-S�bastien Goupil	Font support added + Correct bug if passing C to another code
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * $Id: BCGcode128.barcode.php,v 1.1.1.1 2011-05-12 20:31:32 diogo Exp $
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodephp.com
 */
include_once('BCGBarcode1D.php');

define('CODE128_A',	1);			// Table A
define('CODE128_B',	2);			// Table B
define('CODE128_C',	3);			// Table C
class BCGcode128 extends BCGBarcode1D {
	const KEYA_FNC3 = 96;
	const KEYA_FNC2 = 97;
	const KEYA_SHIFT = 98;
	const KEYA_CODEC = 99;
	const KEYA_CODEB = 100;
	const KEYA_FNC4 = 101;
	const KEYA_FNC1 = 102;

	const KEYB_FNC3 = 96;
	const KEYB_FNC2 = 97;
	const KEYB_SHIFT = 98;
	const KEYB_CODEC = 99;
	const KEYB_FNC4 = 100;
	const KEYB_CODEA = 101;
	const KEYB_FNC1 = 102;

	const KEYC_CODEB = 100;
	const KEYC_CODEA = 101;
	const KEYC_FNC1 = 102;

	const KEY_STARTA = 103;
	const KEY_STARTB = 104;
	const KEY_STARTC = 105;

	const KEY_STOP = 106;

	protected $keysA, $keysB, $keysC;
	private $starting_text;
	private $indcheck, $data;
	private $tilde;
	protected $errorText;

	private $shift;
	private $latch;
	private $fnc;

	private $METHOD			= NULL; // Array of method available to create PDF417 (PDF417_TM, PDF417_NM, PDF417_BM)

	/**
	 * Constructor
	 *
	 * @param char $start
	 */
	public function __construct($start = NULL) {
		parent::__construct();

		/* CODE 128 A */
		$this->keysA = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_';
		for($i = 0; $i < 32; $i++) {
			$this->keysA .= chr($i);
		}

		/* CODE 128 B */
		$this->keysB = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~'.chr(127);

		/* CODE 128 C */
		$this->keysC = '0123456789';

		$this->code = array(
			'101111',	/* 00 */
			'111011',	/* 01 */
			'111110',	/* 02 */
			'010112',	/* 03 */
			'010211',	/* 04 */
			'020111',	/* 05 */
			'011102',	/* 06 */
			'011201',	/* 07 */
			'021101',	/* 08 */
			'110102',	/* 09 */
			'110201',	/* 10 */
			'120101',	/* 11 */
			'001121',	/* 12 */
			'011021',	/* 13 */
			'011120',	/* 14 */
			'002111',	/* 15 */
			'012011',	/* 16 */
			'012110',	/* 17 */
			'112100',	/* 18 */
			'110021',	/* 19 */
			'110120',	/* 20 */
			'102101',	/* 21 */
			'112001',	/* 22 */
			'201020',	/* 23 */
			'200111',	/* 24 */
			'210011',	/* 25 */
			'210110',	/* 26 */
			'201101',	/* 27 */
			'211001',	/* 28 */
			'211100',	/* 29 */
			'101012',	/* 30 */
			'101210',	/* 31 */
			'121010',	/* 32 */
			'000212',	/* 33 */
			'020012',	/* 34 */
			'020210',	/* 35 */
			'001202',	/* 36 */
			'021002',	/* 37 */
			'021200',	/* 38 */
			'100202',	/* 39 */
			'120002',	/* 40 */
			'120200',	/* 41 */
			'001022',	/* 42 */
			'001220',	/* 43 */
			'021020',	/* 44 */
			'002012',	/* 45 */
			'002210',	/* 46 */
			'022010',	/* 47 */
			'202010',	/* 48 */
			'100220',	/* 49 */
			'120020',	/* 50 */
			'102002',	/* 51 */
			'102200',	/* 52 */
			'102020',	/* 53 */
			'200012',	/* 54 */
			'200210',	/* 55 */
			'220010',	/* 56 */
			'201002',	/* 57 */
			'201200',	/* 58 */
			'221000',	/* 59 */
			'203000',	/* 60 */
			'110300',	/* 61 */
			'320000',	/* 62 */
			'000113',	/* 63 */
			'000311',	/* 64 */
			'010013',	/* 65 */
			'010310',	/* 66 */
			'030011',	/* 67 */
			'030110',	/* 68 */
			'001103',	/* 69 */
			'001301',	/* 70 */
			'011003',	/* 71 */
			'011300',	/* 72 */
			'031001',	/* 73 */
			'031100',	/* 74 */
			'130100',	/* 75 */
			'110003',	/* 76 */
			'302000',	/* 77 */
			'130001',	/* 78 */
			'023000',	/* 79 */
			'000131',	/* 80 */
			'010031',	/* 81 */
			'010130',	/* 82 */
			'003101',	/* 83 */
			'013001',	/* 84 */
			'013100',	/* 85 */
			'300101',	/* 86 */
			'310001',	/* 87 */
			'310100',	/* 88 */
			'101030',	/* 89 */
			'103010',	/* 90 */
			'301010',	/* 91 */
			'000032',	/* 92 */
			'000230',	/* 93 */
			'020030',	/* 94 */
			'003002',	/* 95 */
			'003200',	/* 96 */
			'300002',	/* 97 */
			'300200',	/* 98 */
			'002030',	/* 99 */
			'003020',	/* 100*/
			'200030',	/* 101*/
			'300020',	/* 102*/
			'100301',	/* 103*/
			'100103',	/* 104*/
			'100121',	/* 105*/
			'122000'	/*STOP*/
		);
		$this->errorText = '';
		$this->setStart($start);
		$this->setTilde(true);

		// Latches and Shifts
		$this->latch = array(
			array(null,			self::KEYA_CODEB,	self::KEYA_CODEC),
			array(self::KEYB_CODEA,		null,			self::KEYB_CODEC),
			array(self::KEYC_CODEA,		self::KEYC_CODEB,	null)
		);
		$this->shift = array(
			array(null,			self::KEYA_SHIFT),
			array(self::KEYB_SHIFT,		null)
		);
		$this->fnc = array(
			array(self::KEYA_FNC1,		self::KEYA_FNC2,	self::KEYA_FNC3,	self::KEYA_FNC4),
			array(self::KEYB_FNC1,		self::KEYB_FNC2,	self::KEYB_FNC3,	self::KEYB_FNC4),
			array(self::KEYC_FNC1,		null,			null,			null)
		);

		// Method available
		$this->METHOD		= array(CODE128_A => 'A', CODE128_B => 'B', CODE128_C => 'C');
	}

	/**
	 * Specifies the start code. Can be 'A', 'B', 'C' or NULL
	 *  - Table A: Capitals + ASCII 0-31 + punct
	 *  - Table B: Capitals + LowerCase + punct
	 *  - Table C: Numbers
	 *
	 * If NULL is specified, the table selection is automatically made.
	 * The default is NULL.
	 *
	 * @param string $table
	 */
	public function setStart($table) {
		if($table !== 'A' && $table !== 'B' && $table !== 'C' && $table !== NULL) $table = NULL;
		$this->starting_text = $table;
	}

	/**
	 * Accepts tilde to be process as a special character.
	 * If true, you can do this:
	 *  - ~~	: to make ONE tilde
	 *  - ~Fx	: to insert FCNx. x is equal from 1 to 4.
	 *
	 * @param boolean $accept
	 */
	public function setTilde($accept) {
		$this->tilde = (bool)$accept;
	}

	/**
	 * Saves Text
	 *
	 * @param string $text
	 */
	public function parse($text) {
		$this->setStartFromText($text);

		$this->errorText = ''; // Reset Error
		$this->text = '';
		$seq = '';

		$currentMode = $this->starting_text;

		// Here, we format correctly what the user gives.
		if(!is_array($text)) {
			$seq = $this->getSequence($text, $currentMode);
			$this->text = $text;
		} else {
			// This loop checks for UnknownText AND raises an error if a character is not allowed in a table
			reset($text);
			while(list($key1, $val1) = each($text)) {			// We take each value
				if(!is_array($val1)) {					// This is not a table
					if(is_string($val1)) {				// If it's a string, parse as unknown
						$seq .= $this->getSequence($val1, $currentMode);
						$this->text .= $val1;
					} else {
						// it's the case of "array(ENCODING, 'text')"
						// We got ENCODING in $val1, calling 'each' again will get 'text' in $val2
						list($key2, $val2) = each($text);
						$seq .= $this->{'setParse' . $this->METHOD[$val1]}($val2, $currentMode);
						$this->text .= $val2;
					}
				} else {						// The method is specified
					// $val1[0] = ENCODING
					// $val1[1] = 'text'
					$value = isset($val1[1]) ? $val1[1] : '';	// If data available
					$seq .= $this->{'setParse' . $this->METHOD[$val1[0]]}($value, $currentMode);
					$this->text .= $value;
				}

				if($this->errorText) {
					break;
				}
			}
		}

		if($seq !== '') {
			$bitstream = $this->createBinaryStream($this->text, $seq);
			$this->setData($bitstream);
		}
	}

	/**
	 * Draws the barcode
	 *
	 * @param resource $im
	 */
	public function draw(&$im) {
		if(!empty($this->errorText)) {
			$this->drawError($im, $this->errorText);
		} else {
			$c = count($this->data);
			if($c === 0) {
				$this->drawError($im, 'No text has been entered.');
			} else {
				for($i = 0; $i < $c; $i++) {
					$this->drawChar($im, $this->data[$i], true);
				}
				$this->drawChar($im, '1', true);
				$this->drawText($im);
			}
		}
	}

	/**
	 * Returns the maximal size of a barcode
	 *
	 * @return int[]
	 */
	public function getMaxSize() {
		$p = parent::getMaxSize();

		// Contains start + text + checksum + stop
		$textlength = count($this->data) * 11 * $this->scale;
		$endlength = 2 * $this->scale; // + final bar

		return array($p[0] + $textlength + $endlength, $p[1]);
	}

	/**
	 * Overloaded method to calculate checksum
	 */
	protected function calculateChecksum() {
		// Checksum
		// First Char (START)
		// + Starting with the first data character following the start character,
		// take the value of the character (between 0 and 102, inclusive) multiply
		// it by its character position (1) and add that to the running checksum.
		// Modulated 103
		$this->checksumValue = $this->indcheck[0];
		$c = count($this->indcheck);
		for($i = 1; $i < $c; $i++) {
			$this->checksumValue += $this->indcheck[$i] * $i;
		}

		$this->checksumValue = $this->checksumValue % 103;
	}

	/**
	 * Overloaded method to display the checksum
	 */
	protected function processChecksum() {
		if($this->checksumValue === false) { // Calculate the checksum only once
			$this->calculateChecksum();
		}
		if($this->checksumValue !== false) {
			return $this->keys[$this->checksumValue];
		}
		return false;
	}

	/**
	 * Specifies the starting_text table if none has been specified earlier.
	 *
	 * @param string $text
	 */
	private function setStartFromText($text) {
		if($this->starting_text === NULL) {
			// If we have a forced table at the start, we get that one...
			if(is_array($text)) {
				if(is_array($text[0])) {
					// Code like array(array(ENCODING, ''))
					$this->starting_text = $this->METHOD[$text[0][0]];
					return;
				} else {
					if(is_string($text[0])) {
						// Code like array('test') (Automatic text)
						$text = $text[0];
					} else {
						// Code like array(ENCODING, '')
						$this->starting_text = $this->METHOD[$text[0]];
						return;
					}
				}
			}

			// At this point, we had an "automatic" table selection...
			// If we can get at least 4 numbers, go in C; otherwise go in B.
			$tmp = preg_quote($this->keysC, '/');
			if(strlen($text) >= 4 && preg_match('/[' . $tmp . ']/', substr($text, 0, 4))) {
				$this->starting_text = 'C';
			} else {
				if(strpos($this->keysB, $text[0])) {
					$this->starting_text = 'B';
				} else {
					$this->starting_text = 'A';
				}
			}
		}
	}

	/**
	 * Extracts the ~ value from the $text at the $pos.
	 * If the tilde is not ~~, ~F1, ~F2, ~F3, ~F4; an error is raised.
	 *
	 * @param string $text
	 * @param int $pos
	 * @return string
	 */
	private function extractTilde($text, $pos) {
		if($text[$pos] === '~') {
			if(isset($text[$pos + 1])) {
				// Do we have a tilde?
				if($text[$pos + 1] === '~') {
					return '~~';
				} elseif($text[$pos + 1] === 'F') {
					// Do we have a number after?
					if(isset($text[$pos + 2])) {
						$v = intval($text[$pos + 2]);
						if($v >= 1 && $v <= 4) {
							return '~F' . $v;
						} else {
							$this->errorText = 'Bad ~F.  You must provide a number from 1 to 4.';
							return '';
						}
					} else {
						$this->errorText = 'Bad ~F.  You must provide a number from 1 to 4.';
						return '';
					}
				} else {
					// Wrong code
					$this->errorText = 'Wrong code after the ~.';
					return '';
				}
			} else {
				// Wrong code
				$this->errorText = 'Wrong code after the ~.';
				return '';
			}
		} else {
			// Can't happen
			$this->errorText = 'There is no ~ at this location';
			return '';
		}
	}

	/**
	 * Gets the "dotted" sequence for the $text based on the $currentMode.
	 * There is also a check if we use the special tilde ~
	 *
	 * @param string $text
	 * @param string $currentMode
	 * @return string
	 */
	private function getSequenceParsed($text, $currentMode) {
		if($this->tilde) {
			$sequence = '';
			$previousPos = 0;
			while(($pos = strpos($text, '~', $previousPos)) !== false) {
				$tildeData = $this->extractTilde($text, $pos);

				if($tildeData === '') {
					// Something bad happened in extractTilde(). The errorText is already populated.
					return '';
				}

				$simpleTilde = ($tildeData === '~~');
				if($simpleTilde && $currentMode !== 'B') {
					$this->errorText = 'The Table ' . $currentMode . ' doesn\'t contain the character ~.';
					return '';
				}

				// At this point, we know we have ~Fx
				if($tildeData !== '~F1' && $currentMode === 'C') {
					// The mode C doesn't support ~F2, ~F3, ~F4
					$this->errorText = 'The Table C doesn\'t contain the function ' . $tildeData . '.';
					return '';
				}

				$length = $pos - $previousPos;
				if($currentMode === 'C') {
					if($length % 2 === 1) {
						$this->errorText = 'The text "'.$text.'" must have an even number of character to be encoded in Table C.';
						return '';
					}
				}

				$sequence .= str_repeat('.', $length);
				$sequence .= '.';
				$sequence .= (!$simpleTilde) ? 'F' : '';
				$previousPos = $pos + strlen($tildeData);
			}

			// Flushing
			$length = strlen($text) - $previousPos;
			if($currentMode === 'C') {
				if($length % 2 === 1) {
					$this->errorText = 'The text "'.$text.'" must have an even number of character to be encoded in Table C.';
					return '';
				}
			}

			$sequence .= str_repeat('.', $length);

			return $sequence;
		} else {
			return str_repeat('.', strlen($text));
		}
	}

	/**
	 * Parses the text and returns the appropriate sequence for the Table A.
	 *
	 * @param string $text
	 * @param string $currentMode
	 * @return string
	 */
	private function setParseA($text, &$currentMode) {
		$tmp = preg_quote($this->keysA, '/');

		// If we accept the ~ for special character, we must allow it.
		if($this->tilde) {
			$tmp .= '~';
		}

		$match = array();
		if(preg_match('/[^' . $tmp . ']/', $text, $match) === 1) {
			// We found something not allowed
			$this->errorText = 'The text "' . $text . '" can\'t be parsed with the Table A. The character "' . $match[0] . '" is not allowed.';
			return '';
		} else {
			$latch = ($currentMode === 'A') ? '' : '0';
			$currentMode = 'A';

			return $latch . $this->getSequenceParsed($text, $currentMode);
		}
	}

	/**
	 * Parses the text and returns the appropriate sequence for the Table B.
	 *
	 * @param string $text
	 * @param string $currentMode
	 * @return string
	 */
	private function setParseB($text, &$currentMode) {
		$tmp = preg_quote($this->keysB, '/');

		$match = array();
		if(preg_match('/[^' . $tmp . ']/', $text, $match) === 1) {
			// We found something not allowed
			$this->errorText = 'The text "'.$text.'" can\'t be parsed with the Table B. The character "' . $match[0] . '" is not allowed.';
			return '';
		} else {
			$latch = ($currentMode === 'B') ? '' : '1';
			$currentMode = 'B';

			return $latch . $this->getSequenceParsed($text, $currentMode);
		}
	}

	/**
	 * Parses the text and returns the appropriate sequence for the Table C.
	 *
	 * @param string $text
	 * @param string $currentMode
	 * @return string
	 */
	private function setParseC($text, &$currentMode) {
		$tmp = preg_quote($this->keysC, '/');

		// If we accept the ~ for special character, we must allow it.
		if($this->tilde) {
			$tmp .= '~F';
		}

		$match = array();
		if(preg_match('/[^' . $tmp . ']/', $text, $match) === 1) {
			// We found something not allowed
			$this->errorText = 'The text "'.$text.'" can\'t be parsed with the Table C. The character "' . $match[0] . '" is not allowed.';
			return '';
		} else {
			$latch = ($currentMode === 'C') ? '' : '2';
			$currentMode = 'C';

			return $latch . $this->getSequenceParsed($text, $currentMode);
		}
	}

	/**
	 * Depending on the $text, it will return the correct
	 * sequence to encode the text.
	 *
	 * @param string $text
	 * @param string $starting_text
	 * @return string
	 */
	private function getSequence(&$text, &$starting_text) {
		$e = 10000;
		$latLen = array(
			array(0, 1, 1),
			array(1, 0, 1),
			array(1, 1, 0)
		);
		$shftLen = array(
			array($e, 1, $e),
			array(1, $e, $e),
			array($e, $e, $e)
		);
		$charSiz = array(2, 2, 1);

		$startA = $e;
		$startB = $e;
		$startC = $e;
		if($starting_text === 'A') $startA = 0;
		if($starting_text === 'B') $startB = 0;
		if($starting_text === 'C') $startC = 0;

		$curLen = array($startA, $startB, $startC);
		$curSeq = array(null, null, null);

		$nextNumber = false;

		$x = 0;
		$xLen = strlen($text);
		for($x = 0; $x < $xLen; $x++) {
			$input = $text[$x];

			// 1.
			for($i = 0; $i < 3; $i++) {
				for($j = 0; $j < 3; $j++) {
					if(($curLen[$i] + $latLen[$i][$j]) < $curLen[$j]) {
						$curLen[$j] = $curLen[$i] + $latLen[$i][$j];
						$curSeq[$j] = $curSeq[$i] . $j;
					}
				}
			}

			// 2.
			$nxtLen = array($e, $e, $e);
			$nxtSeq = array();

			// 3.
			$flag = false;
			$posArray = array();
			// Special case, we do have a tilde and we process them
			if($this->tilde && $input === '~') {
				$tildeData = $this->extractTilde($text, $x);

				if($tildeData === '') {
					// Something bad happened in extractTilde(). The errorText is already populated.
					return '';
				} elseif($tildeData === '~~') {
					// We simply skip a tilde
					$posArray[] = 1;
					$x++;
				} elseif(substr($tildeData, 0, 2) === '~F') {
					$v = intval($tildeData[2]);
					$posArray[] = 0;
					$posArray[] = 1;
					if($v === 1) {
						$posArray[] = 2;
					}
					$x += 2;
					$flag = true;
				}
			} else {
				$pos = strpos($this->keysA, $input);
				if($pos !== false) {
					$posArray[] = 0;
				}
				$pos = strpos($this->keysB, $input);
				if($pos !== false) {
					$posArray[] = 1;
				}
				$pos = strpos($this->keysC, $input);
				// Do we have the next char a number?? OR a ~F1
				if($nextNumber || ($pos !== false && isset($text[$x + 1]) && strpos($this->keysC, $text[$x + 1]) !== false)) {
					$nextNumber = !$nextNumber;
					$posArray[] = 2;
				}
			}

			$c = count($posArray);
			for($i = 0; $i < $c; $i++) {
				if(($curLen[$posArray[$i]] + $charSiz[$posArray[$i]]) < $nxtLen[$posArray[$i]]) {
					$nxtLen[$posArray[$i]] = $curLen[$posArray[$i]] + $charSiz[$posArray[$i]];
					$nxtSeq[$posArray[$i]] = $curSeq[$posArray[$i]] . '.';
				}
				for($j = 0; $j < 2; $j++) {
					if($j === $posArray[$i]) continue;
					if(($curLen[$j] + $shftLen[$j][$posArray[$i]] + $charSiz[$posArray[$i]]) < $nxtLen[$j]) {
						$nxtLen[$j] = $curLen[$j] + $shftLen[$j][$posArray[$i]] + $charSiz[$posArray[$i]];
						$nxtSeq[$j] = $curSeq[$j] . chr($posArray[$i] + 65) . '.';
					}
				}
			}
			if($c === 0) {
				// We found an unsuported character
				$this->errorText = 'Character ' .  $input . ' not supported.';
				return '';
			}

			if($flag) {
				for($i = 0; $i < 5; $i++) {
					if(isset($nxtSeq[$i])) {
						$nxtSeq[$i] .= 'F';
					}
				}
			}

			// 4.
			for($i = 0; $i < 3; $i++) {
				$curLen[$i] = $nxtLen[$i];
				if(isset($nxtSeq[$i])) {
					$curSeq[$i] = $nxtSeq[$i];
				}
			}
		}

		// Every curLen under $e are possible but we take the smallest !
		$m = $e;
		$k = -1;
		for($i = 0; $i < 3; $i++) {
			if($curLen[$i] < $m) {
				$k = $i;
				$m = $curLen[$i];
			}
		}
		if($k === -1) {
			return '';
		}

		$starting_text = chr($k + 65);

		return $curSeq[$k];
	}

	/**
	 * Depending on the sequence $seq given (returned from getSequence()),
	 * this method will return the code stream in an array. Each char will be a
	 * string of bit based on the Code 128.
	 *
	 * Each letter from the sequence represents bits.
	 *
	 * 0 to 2 are latches
	 * A to B are Shift + Letter
	 * . is a char in the current encoding
	 *
	 * @param string $text
	 * @param string $seq
	 * @return string[][]
	 */
	private function createBinaryStream($text, $seq) {
		$c = strlen($seq);

		$data = array(); // code stream
		$indcheck = array(); // index for checksum

		$currentEncoding = 0;
		if($this->starting_text === 'A') {
			$currentEncoding = 0;
			$indcheck[] = self::KEY_STARTA;
		} elseif($this->starting_text === 'B') {
			$currentEncoding = 1;
			$indcheck[] = self::KEY_STARTB;
		} elseif($this->starting_text === 'C') {
			$currentEncoding = 2;
			$indcheck[] = self::KEY_STARTC;
		}
		$data[] = $this->code[103 + $currentEncoding];

		$temporaryEncoding = -1;
		for($i = 0, $counter = 0; $i < $c; $i++) {
			$input = $seq[$i];
			$inputI = intval($input);
			if($input === '.') {
				$this->encodeChar($data, $currentEncoding, $seq, $text, $i, $counter, $indcheck);
				if($temporaryEncoding !== -1) {
					$currentEncoding = $temporaryEncoding;
					$temporaryEncoding = -1;
				}
			} elseif($input >= 'A' && $input <= 'B') {
				// We shift
				$encoding = ord($input) - 65;
				$shift = $this->shift[$currentEncoding][$encoding];
				$indcheck[] = $shift;
				$data[] = $this->code[$shift];
				if($temporaryEncoding === -1) {
					$temporaryEncoding = $currentEncoding;
				}
				$currentEncoding = $encoding;
			} elseif($inputI >= 0 && $inputI < 3) {
				$temporaryEncoding = -1;
				// We latch
				$latch = $this->latch[$currentEncoding][$inputI];
				if($latch !== NULL) {
					$indcheck[] = $latch;
					$data[] = $this->code[$latch];
					$currentEncoding = $inputI;
				}
			}
		}

		return array($indcheck, $data);
	}

	private function encodeChar(&$data, $encoding, $seq, $text, &$i, &$counter, &$indcheck) {
		if(isset($seq[$i + 1]) && $seq[$i + 1] === 'F') {
			// We have a flag !!
			if($text[$counter + 1] === 'F') {
				$number = $text[$counter + 2];
				$fnc = $this->fnc[$encoding][$number - 1];
				$indcheck[] = $fnc;
				$data[] = $this->code[$fnc];
				// Skip F + number
				$counter += 2;
			} else {
				// Not supposed
			}
			$i++;
		} else {
			if($encoding === 2) {
				// We take 2 numbers in the same time
				$code = (int)substr($text, $counter, 2);
				$indcheck[] = $code;
				$data[] = $this->code[$code];
				$counter++;
				$i++;
			} else {
				$keys = ($encoding === 0) ? $this->keysA : $this->keysB;
				$pos = strpos($keys, $text[$counter]);
				$indcheck[] = $pos;
				$data[] = $this->code[$pos];
			}
		}
		$counter++;
	}

	/**
	 * Saves data into the classes.
	 *
	 * This method will save data, calculate real column number
	 * (if -1 was selected), the real error level (if -1 was
	 * selected)... It will add Padding to the end and generate
	 * the error codes.
	 *
	 * @param array $data
	 */
	private function setData($data) {
		$this->indcheck = $data[0];
		$this->data = $data[1];
		$this->calculateChecksum();
		$this->data[] = $this->code[$this->checksumValue];
		$this->data[] = $this->code[self::KEY_STOP];
	}
};
?>