import React from 'react';
import { Container } from 'reactstrap';
import Sidebar from './sidebar/Sidebar';
import Body from './content/Body';
import Navbar from './header/Navbar';

class Dashboard extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="Container">
                <Sidebar/>
                <Navbar/>
                <Body/>
            </div>
        );
    }
}

export default Dashboard;