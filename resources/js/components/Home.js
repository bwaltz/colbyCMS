import React from 'react';
import Menu from './Menu.js';

const ColbyCMS = window.colbyCMS;
import _findIndex from 'lodash/findIndex';

const Home = () => (
    <div className="container-fluid">
        <div className="row">
            <Menu />
            <main
                role="main"
                className="col-md-9 ml-sm-auto col-lg-10 px-4"
                style={{ paddingTop: '75px' }}
            >
                <div>
                    <h1 style={{ fontSize: '1.4em', paddingBottom: '20px' }}>
                        Greetings, {ColbyCMS.currentUser.name}
                    </h1>
                </div>
                <div className="row">
                    <div className="col-md-4">
                        <div className="card">
                            <div className="card-header">Featured Card</div>
                            <div className="card-body">
                                <h5 className="card-title">
                                    Special title treatment
                                </h5>
                                <p className="card-text">
                                    With supporting text below as a natural
                                    lead-in to additional content.
                                </p>
                                <a href="#" className="btn btn-primary">
                                    Go somewhere
                                </a>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="card">
                            <div className="card-header">Some Other Card</div>
                            <div className="card-body">
                                <h5 className="card-title">
                                    Special title treatment
                                </h5>
                                <p className="card-text">
                                    With supporting text below as a natural
                                    lead-in to additional content.
                                </p>
                                <a href="#" className="btn btn-primary">
                                    Go somewhere
                                </a>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="card">
                            <div className="card-header">
                                Analytics of some kind
                            </div>
                            <div className="card-body">
                                <h5 className="card-title">
                                    Special title treatment
                                </h5>
                                <p className="card-text">
                                    With supporting text below as a natural
                                    lead-in to additional content.
                                </p>
                                <a href="#" className="btn btn-primary">
                                    Go somewhere
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="row" style={{ marginTop: '20px' }}>
                    {_findIndex(
                        ColbyCMS.currentUser.permissions,
                        o => o.name === 'admin.add.dashboard.cards'
                    ) >= 0 && (
                        <div className="col-md-4">
                            <div
                                style={{
                                    display: 'flex',
                                    backgroundColor: '#ddd',
                                    padding: '4em',
                                    justifyContent: 'center',
                                }}
                            >
                                + ADD
                            </div>
                        </div>
                    )}
                </div>
            </main>
        </div>
    </div>
);

export default Home;
