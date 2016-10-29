import React from 'react';
import Sidebar from './layout/sidebar/Sidebar';
import Body from './layout/Body';
import Navbar from './layout/header/Navbar';

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