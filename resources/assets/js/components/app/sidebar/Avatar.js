import React from 'react';
import {Container, Row, Col } from 'reactstrap';

class LockoutIcon extends React.Component {

    render() {
        return (
            <a href="dash/lock"><i className="Avatar__icon-lock"></i></a>
        );
    }

}

class Sidebar extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="Avatar">
                <Container fluid>
                    <Row>
                        <Col xs="4">
                            <img src="/images/avatar.png"  className="Avatar__img"/>
                        </Col>
                        <Col xs="8">
                            <span  className="Avatar__name">Andres Zapata</span>
                            <LockoutIcon/>
                        </Col>
                    </Row>
                </Container>
            </div>
        );
    }
}

export default Sidebar;