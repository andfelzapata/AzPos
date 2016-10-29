import React from 'react';

class Lockout extends React.Component {

    lockApp(e) {
        e.preventDefault();
        console.log('Locking app');
    }

    render() {
        return (
            <a className="Lockout" onClick={this.lockApp.bind(this)}>
                <i className="Lockout__icon"></i>
            </a>
        );
    }

}

export default Lockout;