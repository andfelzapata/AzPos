import React from 'react';
import {Container, Row, Col } from 'reactstrap';
import Lockout from './Lockout';

class Sidebar extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="Avatar">
                <Container fluid>
                    <Row className="FlexCenter">
                        <Col xs="4">
                            <img src="/images/avatar.png"  className="Avatar__img"/>
                        </Col>
                        <Col xs="8" className="FlexCenter">
                            <span  className="Avatar__name">Andres Zapata</span>
                            <Lockout/>
                        </Col>
                    </Row>
                </Container>
            </div>
        );
    }
}

export default Sidebar;