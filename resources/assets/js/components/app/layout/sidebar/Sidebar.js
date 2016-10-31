import React from 'react';
import Avatar from '../../common/Avatar';
import sidebarSections from './sidebarSections';
import SidebarControlBtn from './SidebarControlBtn';
import SidebarSection from './SidebarSection';
import AdministrationSidebar from './AdministrationSidebar';
import ChatSidebar from './ChatSidebar';
import StatisticsSidebar from './StatisticsSidebar';
import RemindersSidebar from './RemindersSidebar';

[    {
    name: "administration",
    icon: "fa-tachometer",
    initialPosition: 0,
    left:0,
    active: true
},

    {
        name: "chat",
        icon: "fa-comments",
        initialPosition: 100,
        left:100,
        active: false
    },

    {
        name: "statistics",
        icon: "fa-pie-chart",
        initialPosition: 200,
        left:200,
        active: false
    },

    {
        name: "reminders",
        icon: "fa-bell",
        initialPosition: 300,
        left:300,
        active: false
    }
]

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

        let sidebarSections = [...this.state.sidebarSections].map((section) => {
            if(section['name'] == sectionName) {
                section['active'] = true;
                section['left'] = 0;
            }

            else {
                section['active'] = false;
                const displacement = sidebar * 100;
                section['left'] = section['initialPosition'] - displacement;
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

        let ChildSidebar;

        switch (sidebar.name) {
            case "administration":
                ChildSidebar = <AdministrationSidebar></AdministrationSidebar>;
                break;
            case "chat":
                ChildSidebar = <ChatSidebar></ChatSidebar>;
                break;
            case "statistics":
                ChildSidebar = <StatisticsSidebar></StatisticsSidebar>;
                break;
            case "reminders":
                ChildSidebar = <RemindersSidebar></RemindersSidebar>;
                break;
        }

        return (
            <SidebarSection key={key} sidebar={key} sidebarName={sidebar.name} left={sidebar.left}>
                {ChildSidebar}
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