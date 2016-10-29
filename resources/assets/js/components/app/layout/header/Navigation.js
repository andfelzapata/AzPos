import React from 'react';
import { Container, Row, Col, Navbar, NavbarBrand, Nav, NavItem, NavLink } from 'reactstrap';

class Navigation extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Container className="Navbar" fluid>
                <Row>
                    <Col xs="12">
                        <Navbar full fixed="top" className="Navbar__nav">
                            <Container fluid>
                                <Row>
                                    <Col x="3" className="hidden-lg-up">
                                        <ul className="navbar nav float-xs-left">
                                            <li role="presentation">
                                                <a href="#show-sidebar" className="Sidebar-button">
                                                    <i className="fa fa-bars" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </Col>

                                    <Col sm="4" xs="6">
                                        <NavbarBrand href="/dashboard" className="NavbarBrand">
                                            <div className="NavbarBrand__Container">
                                                <span className="NavbarBrand__Logo">
                                                    <i className="fa fa-coffee" aria-hidden="true"></i>
                                                </span>
                                                <span className="NavbarBrand__Name">
                                                    Cavas y Café
                                                </span>
                                            </div>
                                        </NavbarBrand>
                                    </Col>

                                    <Col sm="8" xs="3" className="float-xs-right text-xs-right collapse-right   ">
                                        <Nav className="NavActions flex-center nav-inline">
                                            <NavItem className="NavActions__Action">
                                                <NavLink href="#" className="NavActions__ActionLink">
                                                    <i className="fa fa-cutlery" aria-hidden="true"></i>
                                                </NavLink>
                                            </NavItem>
                                            <NavItem className="NavActions__Action">
                                                <NavLink href="#" className="NavActions__ActionLink">
                                                    <i className="fa fa-line-chart" aria-hidden="true"></i>
                                                </NavLink>
                                            </NavItem>
                                            <NavItem className="NavActions__Action">
                                                <NavLink href="#" className="NavActions__ActionLink">
                                                    <i className="fa fa-bullhorn" aria-hidden="true"></i>
                                                </NavLink>
                                            </NavItem>
                                        </Nav>

                                        <Nav className="NavActions NavActions--Logout flex-center nav-inline">
                                            <NavItem className="NavActions__Action NavActions__Action--Logout">
                                                <NavLink href="#" className="NavActions__ActionLink NavActions__ActionLink--Logout">
                                                    <i className="fa fa-power-off" aria-hidden="true"></i>
                                                </NavLink>
                                            </NavItem>
                                        </Nav>
                                    </Col>

                                </Row>
                            </Container>
                        </Navbar>
                    </Col>
                </Row>
            </Container>
        );
    }
}

export default Navigation;