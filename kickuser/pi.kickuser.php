<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kickuser {

    public function logout() 
    {
        $member_id = ee()->TMPL->fetch_param('member_id');    

        $member = ee('Model')->get('Member')->filter('member_id', $member_id)->first();

        // kill all sessions for this member.
        $member->getModelFacade()->get('Session')->delete();

        // kill all sessions except current one.
        /*
		$member->getModelFacade()->get('Session')
			->filter('session_id', '!=', (string) ee()->session->userdata('session_id'))
            ->delete();
        */
        // invalidate any other sessions' remember me cookies
        ee()->remember->delete_others($member_id);

        return $member_id;

    }

}