import React from 'react';

class Loading extends React.Component {

    render() {
        return (
            <div className="Loading-Spinner">
                <img src="/images/loading.gif" className="Loading-Spinner__image"/>
            </div>
        );
    }

}

export default Loading;