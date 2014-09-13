<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

class Trek extends BehatContext
{
    public function __construct()
    {

    }

    /**
     * Get Mink session from MinkContext
     */
    public function getSession($name = null)
    {
        return $this->getMainContext()->getSession($name);
    }

    /**
     * @Then /^I wait for the suggestion box to appear$/
     */
    public function iWaitForTheSuggestionBoxToAppear()
    {
        $this->getSession()->wait(5000,
            "$('.suggestions-results').children().length > 0"
        );
    }


    /**
     * @Given /^I wait for the page to load$/
     */
    public function iWaitForThePageToLoad()
    {
        sleep( 5 );
    }

    /**
     * Click on the element with the provided xpath query
     *
     * @When /^I click on the element with xpath "([^"]*)"$/
     */
    public function iClickOnTheElementWithXPath($xpath)
    {
        $session = $this->getSession(); // get the mink session
        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('xpath', $xpath)
        ); // runs the actual query and returns the element

        // errors must not pass silently
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate XPath: "%s"', $xpath));
        }

        // ok, let's click on it
        $element->click();

    }


    /**
     * Click on the element with the provided CSS Selector
     *
     * @When /^I click on the element with css selector "([^"]*)"$/
     */
    public function iClickOnTheElementWithCSSSelector($cssSelector)
    {
        $session = $this->getSession();

        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('css', $cssSelector) // just changed xpath to css
        );
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS Selector: "%s"', $cssSelector));
        }

        $element->click();

    }


    /**
     * @Then /^I show the bike menu$/
     *
     * This will open the bike menu
     */
    public function iShowTheBikeMenu()
    {
        $session = $this->getSession();

        $script = '$( "#bike_menu_wrapper" ).show();';

        $session->executeScript( $script );
    }

    /**
     * @Then /^I clicked the search button$/
     */
    public function iClickedTheSearchButton()
    {
        $session = $this->getSession();

        $script = '$("#search_form").submit();';

        $session->executeScript( $script );
    }


    /**
     * @Then /^I debug the "([^"]*)" with xpath$/
     */
    public function iDebugTheWithXpath($xpath)
    {
        $session = $this->getSession(); // get the mink session
        $url = $session->getPage();
        //$statuscode = $session->getStatusCode();
        //var_dump($statuscode); exit;

        //$result = $session->evaluateScript( 'return $("model_count").html();' );
        $result = $session->evaluateScript('return function(){return $("'.$xpath.'").html();}()');
        //echo $session->getCurrentUrl()."\n";
        var_dump( $result );


    }

    /**
     * @Then /^I click the play button on the video with css selector "([^"]*)"$/
     */
    public function iClickThePlayButtonOnTheVideoWithCssSelector2($selector)
    {
        $session = $this->getSession();
        $script = 'jwplayer("'.$selector.'").play();';
        $session->executeScript( $script );
    }

    /**
     * @Then /^the video with css selector "([^"]*)" should play\.$/
     */
    public function theVideoWithCssSelectorShouldPlay2($selector)
    {
        $session = $this->getSession();
        //$script = 'return function(){return jwplayer("apollo_master").getVolume()}()';
        $script = 'return function(){var x=jwplayer("apollo_master").getVolume(); return "hi: "+x;}()';
        echo $script;
        $result = $session->evaluateScript( $script );
        echo "\nstate: ".$result;
        if( $result == 'PLAYING' )
        {
            echo "Your video is playing";
        }
        else
        {
            throw new \InvalidArgumentException("The video is not playing");
        }
    }

    /**
     * @When /^I click on the "([^"]*)" tab$/
     */
    public function iClickOnTheTab($tab)
    {
        $session = $this->getSession(); // get the mink session

        $session->executeScript('goToTab("'.$tab.'");');
    }

    /**
     * @Then /^I should get a status of (\d+)$/
     */
    public function iShouldGetAStatusOf($code)
    {
        $session = $this->getSession(); // get the mink session
        $statuscode = $session->getStatusCode();
        if (intval($statuscode) == intval($code))
        {
            echo "Status Code: ".$statuscode;
        }
        else
        {
            throw new \InvalidArgumentException("Status Code did not match: ".$statuscode);
        }
    }
}