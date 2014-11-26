Feature: Homepage
  To navigate through the page
  Visitors should be able
  To click on links and see content

  Background:

    When I am on homepage

  Scenario: Simple navigation
    And I click "Start Searching Products"
    Then I should be redirected to empty search page

  Scenario: Home link
    When I click "Home" link
    Then I should see text "Welcome to ONGR demo site"

  Scenario: About link
    When I click "About" link
    Then I should see text "Sample ONGR about page"
