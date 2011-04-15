<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed.');

/**
 * Easy access to a user's session history.
 *
 * @author				Stephen Lewis
 * @package				Tracks
 * @version				1.0.0
 */

$plugin_info = array(
	'pi_author'			=> 'Stephen Lewis',
	'pi_author_url'		=> 'http://experienceinternet.co.uk/',
	'pi_description'	=> "Easy access to a user's session history.",
	'pi_name'			=> 'Tracks',
	'pi_usage'			=> Tracks::usage(),
	'pi_version'		=> '1.0.0'
);


class Tracks {

	public $return_data = '';


	/* --------------------------------------------------------------
	 * PUBLIC METHODS
	 * ------------------------------------------------------------ */

	/**
	 * PHP4 constructor. I seem to recall that EE requires it.
	 *
	 * @access	public
	 * @return	void
	 */
	public function Tracks()
	{
		$this->__construct();
	}
	

	/**
	 * PHP5 constructor.
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		global $FNS, $SESS, $TMPL;

		$wayback = $TMPL->fetch_param('wayback') ? intval($TMPL->fetch_param('wayback')) : 1;

		if ( ! is_int($wayback) OR ! $wayback)
		{
			$this->return_data = '';
			return;
		}

		$this->return_data = isset($SESS->tracker[$wayback])
			? $FNS->create_url($SESS->tracker[$wayback])
			: '';
	}


	/**
	 * Usage instructions.
	 *
	 * @access	public
	 * @return	string
	 */
	public function usage()
	{
		ob_start();
?>
The Tracks plugin provides easy access the the current user's session history.

To return the current URL:
{exp:tracks wayback='0'}

To return the previous page:
{exp:tracks wayback='1'}
{exp:tracks}				// Defaults to '1'

And so forth...
<?php
		$usage = ob_get_clean();
		return $usage;
	}

}


/* End of file			: pi.tracks.php */
/* File location		: system/plugins/pi.tracks.php */
