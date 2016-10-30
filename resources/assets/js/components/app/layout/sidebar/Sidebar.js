import React from 'react';
import { Row, Col } from 'reactstrap';
import Avatar from '../../common/Avatar';
import sidebarSections from '../../app/sidebarSections';

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

class SidebarSection extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        const styling = {
            left: `${this.props.left}%`
        }

        return (
            <div className="Sidebar__Section" style={styling}>
                {this.props.children}
            </div>
        );
    }
}


class Sidebar extends React.Component {
    constructor(props) {
        super(props);

        this.renderSidebarButton = this.renderSidebarButton.bind(this);
        this.showActiveSection = this.showActiveSection.bind(this);

        this.state = {
            sidebarSections: sidebarSections
        }
    }

    showActiveSection(sectionName, sidebar) {

        let sidebarSections = [...this.state.sidebarSections].map((section, index) => {
            if(section['name'] == sectionName) {
                section['active'] = true;
                section['left'] = 0;
            }

            else {
                section['active'] = false;
                section['left'] = section['initialPosition'] - sidebar * 100;
            }

            return section;
        });

        this.setState({
            sidebarSections
        })

    }

    renderSidebarButton(sidebar, key) {

        const isActive = sidebar.active ? true : false;

        return (
            <SidebarControlBtn
                key={key}
                sidebar={key}
                sidebarName={sidebar.name}
                active={isActive}

                showActiveSection={this.showActiveSection}>

                <i className={`fa ${sidebar.icon}`} aria-hidden="true"></i>

            </SidebarControlBtn>
        );
    }

    renderSidebarSection(sidebar, key) {
        return (
            <SidebarSection key={key} sidebar={key} sidebarName={sidebar.name} left={sidebar.left}>
                {sidebar.name}
            </SidebarSection>
        );
    }

    render() {

        const sidebars = [...this.state.sidebarSections];

        return (
            <div className="Sidebar">

                <Avatar></Avatar>

                <div className="Sidebar__Container">

                    <div className="Sidebar__Controls">

                        {sidebars.map(this.renderSidebarButton)}

                    </div>

                    <div className="Sidebar__Sections">

                        {sidebars.map(this.renderSidebarSection)}

                    </div>

                </div>
            </div>
        );
    }
}

export default Sidebar;