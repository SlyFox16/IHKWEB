<?php
//change 111
class Webhook extends CAction
{
    public function run()
    {

        $boolDebugLogging = TRUE;

        $arrConfig['NICE_CAPTION'] = array(
            'repository' => 'IHKWEB',
            'execute' => array(
                'cd ' . Yii::getPathOfAlias('webroot') . '; git reset --hard HEAD 2>&1; git clean -f -d 2>&1; git pull 2>&1'
            )
        );
        // Make sure the configuration is setup
        if (!isset($arrConfig) || empty($arrConfig)) {
            Yii::log("GitHub Webhook Error: missing config.php or no configuration definitions setup", "error");
            exit;
        }

        // Check for the GitHub WebHook Payload
        if (!file_get_contents("php://input")) {
            Yii::log("GitHub Webhook Error: missing expected POST parameter 'payload'", "error");
            exit;
        }

        // Grab the tastylious JSON payload from GitHub
        $objPayload = json_decode(file_get_contents("php://input"));

        // Loop through the configs to see which one matches the payload
        foreach ($arrConfig as $strSiteName => $arrSiteConfig) {

            // Merge in site config defaults
            $arrSiteConfig = array_merge(
                array(
                    'repository' => '*',
                    'branch' => '*',
                    'username' => '*',
                    'execute' => array()
                ),
                $arrSiteConfig
            );

            $boolPassesChecks = TRUE;

            // Repository name check
            if (($arrSiteConfig['repository'] != '*') && ($arrSiteConfig['repository'] != $objPayload->repository->name)) {
                $boolPassesChecks = FALSE;
            }

            // Branch name check
            if (($arrSiteConfig['branch'] != '*') && ('refs/heads/' . $arrSiteConfig['branch'] != $objPayload->ref)) {
                $boolPassesChecks = FALSE;
            }

            // Username name check
            if (($arrSiteConfig['username'] != '*') && ($arrSiteConfig['username'] != $objPayload->head_commit->committer->username)) {
                $boolPassesChecks = FALSE;
            }

            // Execute the commands if we passed all the checks
            if ($boolPassesChecks) {
                $arrSiteConfig['execute'] = (array)$arrSiteConfig['execute'];

                foreach ($arrSiteConfig['execute'] as $arrCommand) {
                    $arrOutput = array();
                    exec($arrCommand, $arrOutput);

                    if (isset($boolDebugLogging) && $boolDebugLogging) {
                        Yii::log("GitHub Webhook Update (" . $strSiteName . "):\n" . implode("\n", $arrOutput), "error");
                    }
                }
            }
        }
    }
}
