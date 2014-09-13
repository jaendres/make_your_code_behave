Feature: Search
  In order to see a word definition
  As a website user
  I need to be able to search for a word

  @javascript
  Scenario: Searching for a page that does exist
    Given I am on "http://en.wikipedia.org/wiki/Main_Page"
    When I fill in "searchInput" with "Behavior Driven Development"
    And I press "searchButton"
    Then I should see "software development process"

  @javascript
  Scenario: Searching for a page that does NOT exist
    Given I am on "http://en.wikipedia.org/wiki/Main_Page"
    When I fill in "searchInput" with "Glory Driven Development"
    And I press "searchButton"
    Then I should see "Search results"

  @javascript
  Scenario: Searching for a page with autocompletion
    Given I am on "/wiki/Main_Page"
    When I fill in "searchInput" with "Behavior Driv"
    And I wait for the suggestion box to appear
    Then I should see "Behavior-Driven Development"