<?php
class Social extends  CWidget
{
    private $allow = 0;

    public function run()
    {
        $socials = array('facebook_url', 'twitter_url', 'linkedin_url', 'gp_url');

        $social = $this->checkSocial($socials);

        if ($this->allow)
            $this->render("social", $social);
    }

    private function checkSocial($socials)
    {
        $socialList = array();
        foreach($socials as $social)
        {
            $socialList[$social] = yiisetting($social, '');

            if($socialList[$social] != '#' && $socialList[$social] != '')
                $this->allow = 1;
        }

        return $socialList;
    }
}