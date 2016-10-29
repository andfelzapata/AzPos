import React from 'react';
import { Container } from 'reactstrap';
import Sidebar from './sidebar/Sidebar';
import Body from './content/Body';
import Navbar from './header/Navbar';

class Dashboard extends React.Component {
    constructor(props) {
        super(props);
    }

    componentDidMount() {
        setTimeout(() => {
            const spinner = document.getElementsByClassName('Loading-Spinner')[0];
            document.body.removeChild(spinner);
        }, 500);
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