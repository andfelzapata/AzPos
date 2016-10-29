import React from 'react';
import { Row, Col } from 'reactstrap';

class Body extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="Body">
                <Row>
                    <Col xs="12">
                        I'm am the main content
                    </Col>
                </Row>
            </div>
        );
    }
}

export default Body;