import React from 'react';
import { Row, Col } from 'reactstrap';
import Avatar from '../../common/Avatar';

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