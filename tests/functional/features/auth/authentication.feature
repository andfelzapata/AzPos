Feature: The system needs to provide authentication for its users
  In order to access securely the AzPos application
  As a staff member
  I want to be able to login into the system with valid credentials

Scenario: Login attempt with valid credentials should succeed
  Given there is an user "jonsnow" with password "notabastard"
  And I am on the login page
  When I try to login with username "jonsnow" and password "notabastard"
  Then I should be authenticated
  Then I should be redirected to the dash

  Scenario: Login attempt with valid email should succeed
    Given there is an user "jonsnow" with password "notabastard"
    And I am on the login page
    When I try to login with username "jonsnow@winterfell.north" and password "notabastard"
    Then I should be authenticated
    Then I should be redirected to the dash

Scenario: Login attempt with invalid credentials should fail
  Given there is an user "jonsnow" with password "ILoveYgritte"
  And I am on the login page
  When I try to login with username "jonsnow" and password "ILoveMelisandre"
  Then I should not be authenticated
  And I should see credentials don't match message

Scenario: Login attempt with non-existent username should fail
  Given there is an user "jonsnow" with password "kinginthenorth"
  And I am on the login page
  When I try to login with username "ramsay" and password "lordofthenorth"
  Then I should not be authenticated
  And I should see username does not exist message

Scenario: Username and password are required
  Given I am on the login page
  When I try to login with empty username and password
  Then I should see a validation error
  And the status code should be "422"