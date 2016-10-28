import React from 'react';
import { Row, Col } from 'reactstrap';
import Avatar from './Avatar';

class Sidebar extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="Sidebar">
                <Avatar></Avatar>
                I am the sidebar
            </div>
        );
    }
}

export default Sidebar;