import React, { useState } from "react";
import { BrowserRouter, Outlet, Route, Routes, Link } from "react-router-dom";
import Home from "./Pages/Home";
import Teams from "./Pages/Teams";
import Pokemons from "./Pages/Pokemons";
import CreateTeam from "./Components/Team/CreateTeam";
import ListTeam from "./Components/Team/ListTeam";
import EditTeam from "./Components/Team/EditTeam";

const navItems = [
    {
        title: "HOME",
        link: "/",
    },
    {
        title: "TEAMS",
        link: "/team",
    },
];

function App() {

    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Home navItems={navItems} />}>
                    <Route path="" element={
                        <div style={{
                            minHeight: "1000px",
                            textAlign: "center",
                            textAnchor: "middle",
                        }}>
                            {/* <Link to="/team/list">Show All Teams</Link> */}
                        </div>
                    } />
                    <Route path="team" element={
                        <>
                            <Outlet />
                        </>
                    }>
                        <Route path="list" element={
                            <ListTeam />
                        } />
                        <Route path="create" element={
                            <CreateTeam />
                        } />
                        <Route path=":idTeam/edit" element={
                            <EditTeam />} />
                    </Route>
                </Route>
            </Routes>
        </BrowserRouter>
    );
}

export default App;
