import React from 'react';

class SidebarControlBtn extends React.Component {
    constructor(props) {
        super(props);
    }

    showActiveSection() {
        this.props.showActiveSection(this.props.sidebarName, this.props.sidebar);
    }

    render() {

        const currentClassState = this.props.active ? "Sidebar__Control-Link Sidebar__Control-Link--Active" : "Sidebar__Control-Link";

        return (
            <div className="Sidebar__Control">
                <a className={currentClassState} onClick={this.showActiveSection.bind(this)}>
                    {this.props.children}
                </a>
            </div>
        );
    }
}

export default SidebarControlBtn;