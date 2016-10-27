import React from 'react';
import Request from 'superagent';

class LoginForm extends React.Component {

    constructor(props) {

        super(props);

        this.state = {

            username: '',
            usernameValidation: '',

            password: '',
            passwordValidation: '',

            loginError: '',

        }

        this.csrfToken = document.querySelector('meta[name=csrf-token]').content

        this.onChangeUsername = this.onChangeUsername.bind(this);
        this.onChangePassword = this.onChangePassword.bind(this);
        this.onSubmitForm = this.onSubmitForm.bind(this);

    }

    render () {

        let loginErrorStyles = {
            position: 'absolute',
            right: 0,
            left: 0,
            textAlign: 'center',
            zIndex: 1
        }

        let submitButtonStyles = {
            position: 'relative',
            zIndex: 2,
        }

        return (

          <form onSubmit={this.onSubmitForm}>

            <div className="form-group">

                <input className="form-control" value={this.state.username} onChange={this.onChangeUsername} placeholder="usuario" />
                <span className="ValidationError">{this.state.usernameValidation}</span>

            </div>

            <div className="form-group">

                <input type="password" className="form-control" value={this.state.password} onChange={this.onChangePassword} placeholder="contraseña" />
                <span className="ValidationError">{this.state.passwordValidation}</span>

            </div>

            <button type="submit" value="Login" style={submitButtonStyles} className="btn btn-primary pull-right">Login</button>

            <div className="LoginError" style={loginErrorStyles}> {this.state.loginError} </div>

          </form>

        );

    }

  onChangeUsername(event) {

    const username = event.target.value;
    const usernameValidation = ""

    this.setState({ username, usernameValidation });

  }

  onChangePassword(event) {

      const password = event.target.value;
      const passwordValidation = "";

    this.setState({ password, passwordValidation });

  }

  onSubmitForm(event) {
    event.preventDefault();

    const password = this.state.password;
    const username = this.state.username;

    Request
        .post('login')
        .set('X-CSRF-TOKEN', this.csrfToken)
        .set('Accept', 'application/json')
        .send({username, password})

        .then( (success) => {

            window.location = 'dashboard';

        }, (error) => {

            if(error.status == 422) {
                _.map(error.response.body, (value, key) => {
                    this.setState({ [`${key}Validation`]: value });
                });
            }

            if(error.status == 401) {
                let loginError = error.response.body.pop();
                this.setState({ loginError });
            }

        });


  }

}

export default LoginForm;