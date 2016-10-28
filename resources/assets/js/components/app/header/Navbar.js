import React from 'react';
import { Container } from 'reactstrap';

class Navbar extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <Container className="Navbar" fluid>
                I am the navbar
            </Container>
        );
    }
}

export default Navbar;