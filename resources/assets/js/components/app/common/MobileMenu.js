import React from 'react';
import { Container, Row, Col } from 'reactstrap';

class MobileMenu extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <ul className="pull-left visible-x nav navbar-nav">
                <li role="presentation">
                    <a>
                        <i className="fa fa-bars" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        );
    }
}

export default MobileMenu;