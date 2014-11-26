Feature: Search
  In order to buy products
  Visitors should be able
  to search for them

  Background:

    When I am on search page

  Scenario: General product info
    Then I should see 90 products
    And Products has basic information

  Scenario: Normal search
    When I search for "white"
    Then I should see 3 products
    And All products has "white" in their names

  Scenario: Nonsense search
    When I search for "kljagsdkljasbhdj"
    Then I should see 0 products
    @And I should see text "No products found" #Failing

  @Scenario: Empty search
    @When I search for ""
    @Then I should see 90 products #Failing


  Scenario: Filtering
    When I select "Italy" from category "Country"
    Then I should see 24 products

  Scenario: Filtering again
    When I select "Italy" from category "Country"
    And I select "Australia" from category "Country"
    Then I should see 13 products

  Scenario: Filtering again different
    When I select "Italy" from category "Country"
    And I select "Sparkling" from category "Wine Style"
    Then I should see 4 products

  Scenario: Filtering deselect
    When I select "Italy" from category "Country"
    And I select "Sparkling" from category "Wine Style"
    And I select "Italy" from category "Country"
    Then I should see 7 products

  Scenario: Pagination start
    Then Pagination exists
    And I see last page button
    And I see next page button
    And I see 2-10 page buttons
    And I am on page 1

  Scenario: Pagination end
    When I am on last page
    Then Pagination exists
    And I see first page button
    And I see previous page button
    And I see 5-9 page buttons
    And I am on page 10

  Scenario: Sorting
    When I am sorting by "Price descending"
    Then Products are in price descending order

  Scenario: Sorting 2
    When I am sorting by "Price ascending"
    Then Products are in price ascending order
