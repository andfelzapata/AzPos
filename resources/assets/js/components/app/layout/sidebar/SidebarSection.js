import React from 'react';

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

export default SidebarSection;