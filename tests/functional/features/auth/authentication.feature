Feature: The system needs to provide authentication for its users
  In order to access securely the AzPos application
  As a staff member
  I want to be able to login into the system with valid credentials

Scenario: Login with valid credentials should succeed
  Given there is an user "jonsnow" with password "notabastard"
  And I am on the login page
  When I try to login with username "jonsnow" and password "notabastard"
  Then I should be authenticated
  Then I should be redirected to the dash

Scenario: Login with invalid credentials should fail
  Given there is an user "jonsnow" with password "ILoveYgritte"
  And I am on the login page
  When I try to login with username "jonsnow" and password "ILoveMelisandre"
  Then I should not be authenticated

Scenario: Username and password are required
  Given I am on the login page
  When I try to login with empty username and password
  #Then I should see a validation error
  And the status code should be "422"