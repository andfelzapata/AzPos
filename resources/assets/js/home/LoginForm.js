import React from 'react';
import Request from 'superagent';


class LoginForm extends React.Component {

  constructor(props) {
    
    super(props);

    this.state = {

      username: '',
      
      password: ''

    }

    this.csrfToken = document.querySelector('meta[name=csrf-token]').content

    this.onChangeUsername = this.onChangeUsername.bind(this);
    this.onChangePassword = this.onChangePassword.bind(this);
    this.onSubmitForm = this.onSubmitForm.bind(this);

  }

  render () {

    return (

      <form onSubmit={this.onSubmitForm}>

        <div className="form-group">

          <input className="form-control" value={this.state.username} onChange={this.onChangeUsername} placeholder="usuario" />

        </div>

        <div className="form-group">       

          <input type="password" className="form-control" value={this.state.password} onChange={this.onChangePassword} placeholder="contraseña" />

        </div>

        <button type="submit" value="Login" className="btn btn-primary">Login</button>

      </form>

    );

  }

  onChangeUsername(event) {

    const username = event.target.value;

    this.setState({ username });

  }

  onChangePassword(event) {

    const password = event.target.value;

    this.setState({ password });

  }

  onSubmitForm(event) {
    event.preventDefault();

    const password = this.state.password;
    const username = this.state.username;

    Request
        .post('login')
        .set('X-CSRF-TOKEN', this.csrfToken)
        .send({username, password})
        .end(function(err, rest) {

        });


  }

}

export default LoginForm;