import React from 'react';
import logo from './logo.jpeg';
import './App.css';
import Oath from './Oath';
import ActionButton from './ActionButton';

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      oathCount: 3000,
    };
  }

  handleAction = (action) => {
    this.setState(({ oathCount }) => ({ oathCount: oathCount + action }));
  }

  render() {
    const { oathCount } = this.state;

    return (
      <div className="App">
        <header className="App-header">
          <img src={logo} className="App-logo" alt="logo" />
          <Oath count={oathCount} />
          <div className="action-area">
            <ActionButton type="heart" onAction={this.handleAction} />
            <ActionButton type="sad" onAction={this.handleAction} />
          </div>
        </header>
      </div>
    );
  }
}

export default App;
