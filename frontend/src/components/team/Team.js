import React from 'react';
import Box from "@mui/material/Box";
import TableContainer from "@mui/material/TableContainer";
import Paper from "@mui/material/Paper";
import Table from "@mui/material/Table";
import TableHead from "@mui/material/TableHead";
import TableRow from "@mui/material/TableRow";
import TableCell from "@mui/material/TableCell";
import TableBody from "@mui/material/TableBody";
import EditIcon from '@mui/icons-material/Edit';
import AddIcon from '@mui/icons-material/Add';
import Pokemon from "./Pokemon";
import Button from "@mui/material/Button";
import {useNavigate} from 'react-router-dom';
import {toast} from "react-toastify";

function Team({team}) {
    const navigate = useNavigate();

    function handleEditTeamSubmit(event) {
        try {
            navigate(`/team/${team.id}/edit`);
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    function handleAddPokemonSubmit(event) {
        try {
            if (team.id != null && team.id !== "") {
                fetch(process.env.REACT_APP_BACK_END_API + '/pokemon/' + team.id, {
                    method: "POST",
                })
                    .then(res => res.json())
                    .then(data => toast.success(data.message));
            }
        } catch (e) {
            console.log(e.getMessage);
        }
    }

    return (
        <div key={team.id} style={{
            paddingTop: "20px",
            textAlign: "center",
            paddingBottom: "50px"
        }}>
            <Box sx={{
                backgroundColor: 'primary.main',
            }}>
                <p><b>Team name: {team.name}</b></p>
                <p><b>Base Experience sum: {team.baseExperienceSum}</b></p>
                <ul style={{
                    listStyleType: "none",
                    margin: "0px",
                    padding: "0px",
                    overflow : "hidden",
                    textAlign: "center",
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center"
                }}>
                    <li style={{
                        float: "left",
                        textAlign: "center",
                        padding:"5px",
                        display:"block",
                    }}>
                        <form onSubmit={handleEditTeamSubmit} style={{padding: "10px"}}>
                            <Button variant="contained" type="submit"
                                    color="warning" title="Edit team"><EditIcon/></Button>
                        </form>
                    </li>
                    <li style={{
                        float: "left",
                        textAlign: "center",
                        padding:"5px",
                        display:"block",
                    }}>
                        <form onSubmit={handleAddPokemonSubmit} style={{padding: "10px"}}>
                            <Button variant="contained" type="submit"
                                    color="success" title="Add new pokemon"><AddIcon/></Button>
                        </form>
                    </li>
                </ul>
            </Box>
            <TableContainer component={Paper}>
                <Table sx={{minWidth: 650}} aria-label="simple table">
                    <TableHead>
                        <TableRow>
                            <TableCell><b>Name</b></TableCell>
                            <TableCell align="right"><b>Base Experience</b></TableCell>
                            <TableCell align="right"><b>Image</b></TableCell>
                            <TableCell align="right"><b>Types</b></TableCell>
                            <TableCell align="right"></TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {
                            team && team.pokemonList ? (
                                team.pokemonList.map((pokemon) => (
                                    <Pokemon pokemon={pokemon} key={pokemon.id}/>
                                ))
                            ) : (
                                <p><b>No pokemon inserted for the team {team.name}</b></p>
                            )
                        }
                    </TableBody>
                </Table>
            </TableContainer>
        </div>
    );
}

export default Team;