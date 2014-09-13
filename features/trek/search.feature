# features/search.feature
Feature: Search
  In order to see a word definition
  As a website user
  I need to be able to search for a word
	
@javascript
    Scenario: Searching for a madone
        Given I am on "http://www.trekbikes.com/us/en/search"
        Then I fill in "search_field" with "Madone"
        And I clicked the search button
        Then I wait for the page to load
        And the url should match "/us/en/search/results/"
        And I should see "Choose from 20 models"
        And the response status code should be 200


