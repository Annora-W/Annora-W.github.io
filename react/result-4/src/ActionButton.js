import React from 'react';
import './ActionButton.css';

import { ReactComponent as HeartSVG } from './heart.svg';
import { ReactComponent as SadSVG } from './sad.svg';

const SVGS = {
  heart: HeartSVG,
  sad: SadSVG
};

class ActionButton extends React.Component {
  handleClick = () => {
    const { type, onAction } = this.props;
    const action = type === 'heart' ? 1 : -1;
    onAction(action);
  }

  render() {
    const { type } = this.props;

    return (
      <button
        className={`button ${type}`}
        onClick={this.handleClick}
      >
        {SVGS[type]}
      </button>
    );
  }
}

export default ActionButton;
