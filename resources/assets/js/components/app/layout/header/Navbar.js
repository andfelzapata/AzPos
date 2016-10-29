import React from 'react';
import { Container, Row, Col } from 'reactstrap';
import MobileMenu from '../../common/MobileMenu';

class Navbar extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Container className="Navbar" fluid>
                <Row>
                    <Col xs="3" className="visible-x">
                        <MobileMenu/>
                    </Col>
                    <Col xs="6" sm="4" className="visible-x">
                        <div className="Logo navbar-header">
                            <a href="" className="navbar-brand">
                                Cavas y Café
                            </a>
                        </div>
                    </Col>
                    <Col xs="3" sm="8" className="visible-x">

                    </Col>
                </Row>
            </Container>
        );
    }
}

export default Navbar;